import { useContext, useState } from "react";
import DataContext from "./DataContext";

function Create() {

    const [vardas, setVardas] = useState('');
    const [pavarde, setPavarde] = useState('');
    const [asmensKodas, setAsmensKodas] = useState('');

    const { setCreateClient, saskaitosNr, createModal, setCreateModal, msg, setMsg } = useContext(DataContext);

    const create = () => {
        setCreateClient({ vardas, pavarde, asmensKodas, saskaitosNr });
        setVardas('');
        setPavarde('');
        setAsmensKodas('');
    }
    const close = () => {
        setMsg(null);
        setCreateModal(null);
    }
    if (null === createModal) {
        return null;
    }
    return (
        <div className="modal">
            <div className="modal-dialog modal-dialog-centered">
                <div className="modal-content">
                    <div className="modal-header">
                        <h2 className="modal-title">Sukurti</h2>
                        <button type="button" className="close" data-dismiss="modal" aria-label="Close" onClick={close}>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div className="modal-body">
                        <div className="card">
                            <div className="card-body">
                                <div className="card-body">
                                    <div className="error-msg">{msg ?? null}</div>
                                    <div className="form-group">
                                        <label>Vardas</label>
                                        <input type="text" className="form-control" id="vardas" value={vardas} onChange={e => setVardas(e.target.value)} />
                                    </div>
                                    <div className="form-group">
                                        <label>Pavardė</label>
                                        <input type="text" className="form-control" id="pavarde" value={pavarde} onChange={e => setPavarde(e.target.value)} />
                                    </div>
                                    <div className="form-group">
                                        <label>Asmens kodas</label>
                                        <input type="text" className="form-control" id="asmens_kodas" value={asmensKodas} onChange={e => setAsmensKodas(e.target.value)} />
                                    </div>
                                    <div className="form-group">
                                        <label >Sąskaitos numeris</label>
                                        <input type="text" className="form-control" id="sas_nr" value={saskaitosNr} readOnly />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="modal-footer">
                        <button type="button" className="list-btn btn btn-danger" onClick={create}>Išsaugoti</button>
                        <button type="button" className="btn btn-secondary" data-dismiss="modal" onClick={close}>Atšaukti</button>

                    </div>
                </div>
            </div>
        </div>







    )
}

export default Create;