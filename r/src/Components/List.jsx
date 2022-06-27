import { useContext } from "react";
import DataContext from "./DataContext";
import ListLine from "./ListLine";


function List() {
    const { list, setCreateModal } = useContext(DataContext);
  

    const showModal = () => {
        setCreateModal({});
    }

    return (
        <div className="col-12 mt-5">
            <div className="card">
                <div className="card-header">
                    <h2>Klientų sąrašas</h2>
                </div>
                <div className="card-body">
                    <div>
                        <button type="button" className="btn btn-danger" onClick={showModal}>Pridėti naują klientą</button>
                    </div>
                
                    <table className="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Vardas</th>
                                <th scope="col">Pavardė</th>
                                <th scope="col">Asmens kodas</th>
                                <th scope="col">Sąskaitos numeris</th>
                                <th scope="col">Balansas</th>
                            </tr>
                        </thead>
                        <tbody>
                            {
                                list.map(item => <ListLine key={item.id} item={item}></ListLine>)
                                   
                            }


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    )
}

export default List;