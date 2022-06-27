import { useContext } from "react";
import DataContext from "./DataContext";

function ListLine ({item}){

    const {setDelClient, setEditClient} = useContext(DataContext);

    const deleteClient = () => {
        setDelClient(item);
     }
    const edita = () => {
        setEditClient(item);
    }
    return (
            <tr className="one-client">
            <td>{item.vardas}</td>
            <td>{item.pavarde}</td>
            <td>{item.asmensKodas}</td>
            <td>{item.saskaitosNr}</td>
            <td>{(item.suma).toFixed(2)}</td>
            <td className="clients-buttons">
                <button type="button" className="list-btn btn btn-secondary" onClick={edita}>Redaguoti</button>
                <button type="button" className="list-btn btn btn-danger" onClick={deleteClient}>Ištrinti</button>
            </td>
        </tr>
    )
}
export default ListLine;