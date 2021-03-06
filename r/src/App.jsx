import './bootstrap.css';
import './App.scss';
import DataContext from './Components/DataContext';
import List from './Components/List';
import { useEffect, useState } from "react";
import axios from 'axios';
import Create from './Components/Create';
import Edit from './Components/Edit';
import Login from './Components/Login';
import { authConfig, login, logout } from './Functions/auth';

function App() {
  const [latsUpdate, setLastUpdate] = useState(Date.now());
  const [list, setList] = useState([]);
  const [createClient, setCreateClient] = useState(null);
  const [delClient, setDelClient] = useState(null);
  const [editClient, setEditClient] = useState(null);
  const [addMoney, setAddMoney] = useState(null);
  const [withdrowMoney, setWithdrowMoney] = useState(null);
  const [saskaitosNr, setSaskaitosNr] = useState('');
  const [createModal, setCreateModal] = useState(null);
  const [msg, setMsg] = useState(null);
  const [loginData, setLoginData] = useState(null);
  const [user, setUser] = useState(null);
  const [refresh, setRefresh] = useState(true);

  const doLogout = () => {
    logout();
    setRefresh(r => !r);
  }

  useEffect(()=> {
    axios.get('http://savers-bank.lt/auth', authConfig())
    .then(res => {
      if(res.data.user){
        setUser(res.data.user)
        setTimeout(() =>{ // nustatome laika
          logout();
          setRefresh(r => !r)
        }, 100000)
      }
      else {
        setUser(null);
        setMsg(res.data.msg);
      }
    })
  }, [refresh])

  useEffect(() => {
    axios.get('http://savers-bank.lt/list', authConfig())
      .then(res => {
        if (res.data == null) {
          setList({});
        }
        setList(res.data)
      })
  }, [latsUpdate]);

  useEffect(() => {
    if (loginData == null) return;
    axios.post('http://savers-bank.lt/login', loginData)
      .then(res => {
        if (res.data.token) {
          login(res.data.token)
          setRefresh(r => !r)
        }
        else {
          setMsg(res.data.msg)
        }
        // console.log(res.data)
      })
  }, [loginData]);

  useEffect(() => {
    axios.get('http://savers-bank.lt/createAccount') // o cia gal visur authConfig'u reikia?
      .then(res => setSaskaitosNr(res.data))
  }, [createClient])

  useEffect(() => {
    if (createClient === null) return;
    axios.post('http://savers-bank.lt/createAccount', createClient, authConfig())
      .then(res => {
        setMsg(res.data.msg)
        setLastUpdate(Date.now())
      })
  }, [createClient])

  useEffect(() => {
    if (addMoney === null) return;
    axios.put('http://savers-bank.lt/add/' + addMoney.id, addMoney, authConfig())
      .then(res => {
        setMsg(res.data.msg)
        if (typeof (res.data.user) != 'undefined') { //OK?
          setEditClient(res.data.user);
        }
        setLastUpdate(Date.now())
      }
      )
  }, [addMoney])

  useEffect(() => {
    if (withdrowMoney === null) return;
    axios.put('http://savers-bank.lt/subtract/' + withdrowMoney.id, withdrowMoney, authConfig())
      .then(res => {
        setMsg(res.data.msg);
        if (typeof (res.data.user) != 'undefined') { //OK?
          setEditClient(res.data.user);
        }
        setLastUpdate(Date.now())
      }
      )
  }, [withdrowMoney])

  useEffect(() => {
    if (delClient === null) return;
    axios.delete('http://savers-bank.lt/list/' + delClient.id, authConfig())
      .then(_ => setLastUpdate(Date.now()))
  }, [delClient]);

  
  return (
    <DataContext.Provider value={{ list, setCreateClient, setDelClient, editClient, setEditClient, saskaitosNr, setAddMoney, setWithdrowMoney, createModal, setCreateModal, msg, setMsg, setLoginData }}>
      <nav className="savers-bank">
        <h1>Savers Bank</h1>
        <button className="list-btn btn btn-secondary" onClick={doLogout}>Atsijungti</button>
      </nav>
      <div className="container ">
        <div className="row flex-column">
          {
            user ? <List user={user}/> : <Login/>
          } 
        </div>
      </div>
      <Create></Create>
      <Edit></Edit>
    </DataContext.Provider>
  );
}

export default App;
