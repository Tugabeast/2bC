import React, { useContext } from "react";
import Alert from "react-bootstrap/Alert";
import Context from "../store/context";
import { Link } from "react-router-dom";
import Button from "react-bootstrap/Button";

function AlertBox({ area, workerList, props }) {
  const { state } = useContext(Context);

  //Message to Display in Alert Box
  const messageSuccess = "Todos os trabalhadores estão na zona de segurança";
  const messageError = " Trabalhadores fora da zona de segurança";

  //Method to View the List of Workers for each Zone
  const viewList = (props) => {
    state.listEvent = props;
  };

  return (
    <div>
      <Alert
        className="alert"
        variant={workerList.length == 0 ? "success " : "danger"}
        onClick={(e) => {
          e.preventDefault();
          viewList(props);
        }}
      >
        <Alert.Heading>
          {" "}
          {workerList.length == 0 ? messageSuccess : messageError}
        </Alert.Heading>

        <h1>{area.length}</h1>

        <Link to="/Workers">
          <Button variant="primary" className="btn">
            Detalhes
          </Button>
        </Link>
        {console.log(workerList.length)}
      </Alert>
    </div>
  );
}

export default AlertBox;
