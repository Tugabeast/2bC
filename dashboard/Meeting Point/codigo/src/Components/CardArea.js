import React, { useContext } from "react";
import Button from "react-bootstrap/Button";
import { Link } from "react-router-dom";
import Context from "../store/context";
import "../styles/CardArea.css";
import * as GrIcons from "react-icons/gr";
import Box from "@material-ui/core/Box";
import { compose, spacing, palette } from "@material-ui/system";
import { styled } from "@material-ui/core/styles";
import PeopleAltIcon from "@material-ui/icons/PeopleAlt";


function CardArea({ area, props, name }) {
  
  const Box = styled("div")(compose(spacing, palette));

  const { state } = useContext(Context);

  //Method to View the List of Workers for each Zone
  const viewList = (props) => {
    state.listEvent = props;
  };

  return (
    <>
      <Box
        p={4}
        onClick={(e) => {
          e.preventDefault();
          viewList(props);
        }}
        
      >
        <div></div>
        <h1 className="card-header">  {name} </h1>

        <div className="card-number">
          <p>{area.length}
          <PeopleAltIcon />
          </p>
          
        </div>

        <Link to="/Workers">
          <Button class="btn">Detalhes</Button>
        </Link>
      </Box>
    </>
  );
}

export default CardArea;
