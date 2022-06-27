import { useContext, useState, useEffect } from "react";
import DataContext from "./DataContext";

function Edit() {

    const { editClient, setEditClient, setAddMoney, setWithdrowMoney, setMsg, msg} = useContext(DataContext);

    const [vardas, setVardas] = useState('');
    const [pavarde, setPavarde] = useState('');
    const [asmensKodas, setAsmensKodas] = useState('');
    const [balansas, setBalansas] = useState('');
    const [saskaitosNr, setSaskaitosNr] = useState('');

    const [amount, setAmount] = useState('');
    const [amountWthdrow, setAmountWthdrow] = useState('');
    //    const {setCreateClient} = useContext(DataContext);

    useEffect(() => {
         if (editClient == null) return;
        setVardas(editClient.vardas);
        setPavarde(editClient.pavarde);
        setAsmensKodas(editClient.asmensKodas);
        setBalansas(editClient.suma);
        setSaskaitosNr(editClient.saskaitosNr)
    }, [editClient])

    const addIt = () => {
        setAddMoney({amount, id: editClient.id })
        setAmount('');
    }
    const wthdrowIt = () => {
        setWithdrowMoney({amountWthdrow, id: editClient.id })
        setAmountWthdrow('');
    }

    const close = () => {
        setMsg(null);
        setEditClient(null);
    }
    //    const create = () => {
    //     setCreateClient ({vardas, pavarde, asmensKodas});
    //     setVardas('');
    //     setPavarde('');
    //     setAsmensKodas('');
    //    }

    if (null === editClient) {
        return null;
    }
    return (
        <div className="modal">
            <div className="modal-dialog modal-dialog-centered">
                <div className="modal-content">
                    <div className="modal-header">
                        <h2 className="modal-title">Redaguoti</h2>
                        <button type="button" className="close" data-dismiss="modal" aria-label="Close" onClick={close}>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div className="modal-body">
                        <div>{msg ?? null}</div>
                        <div className="card">
                            <div className="card-body">
                                <h4>{vardas} {pavarde}</h4>
                                <div>Asmens kodas: {asmensKodas} </div>
                                <div>Sąskaitos nr.: {saskaitosNr}</div>
                                <div>Sąskaitos likutis: <b>{balansas}</b> </div>
                                <div className="form-group">
                                    <label >Prideti</label>
                                    <div className="edit-balance">
                                        <input type="text" className="form-control" id="sas_nr" value={amount} onChange={e => setAmount(e.target.value)}/>
                                        <button type="button" className="btn btn-danger"onClick={addIt}>Pridėti</button>
                                    </div>
                                </div>
                                <div className="form-group in-modal">
                                    <label >Nuskaičiuoti</label>
                                    <div className="edit-balance">
                                        <input type="text" className="form-control" id="sas_nr" value={amountWthdrow} onChange={e => setAmountWthdrow(e.target.value)}/>
                                        <button type="button" className="btn btn-danger" onClick={wthdrowIt}>Nuskaičiuoti</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="modal-footer">
                        <button type="button" className="btn btn-secondary" data-dismiss="modal" onClick={close}>Baigti darbą</button>

                    </div>
                </div>
            </div>
        </div>
    )
}
export default Edit;