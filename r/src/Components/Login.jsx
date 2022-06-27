import { useContext, useState } from "react";
import DataContext from "./DataContext";

function Login() {
    const {setLoginData, msg} = useContext(DataContext);
    const [name, setName]= useState('');
    const [pass, setPass]= useState('');

    const doLogin = () => {
        setLoginData({name, pass})
    }
    return (
        <>
            <form className="login-form">
                <div className="error-msg">{msg}</div>
                <div className="form-group">
                    <label for="exampleInputEmail1">Prisijungimo vardas</label>
                    <input type="email" className="form-control" value={name} onChange={e => setName(e.target.value)}/>
                </div>
                <div className="form-group">
                    <label >Slaptažodis</label>
                    <input type="password" className="form-control" value={pass} onChange={e => setPass(e.target.value)}/>
                </div>
                <button type="button" className="btn btn-danger" onClick={doLogin}>Prisijungti</button>
            </form>
        </>
    )
}

export default Login;