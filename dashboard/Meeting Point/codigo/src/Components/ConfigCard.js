import React, { useState, useContext } from "react";
import Radio from "@material-ui/core/Radio";
import RadioGroup from "@material-ui/core/RadioGroup";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import FormControl from "@material-ui/core/FormControl";
import FormLabel from "@material-ui/core/FormLabel";
import { makeStyles } from "@material-ui/core/styles";
import Context from "../store/context";
import Button from "@material-ui/core/Button";
import { textAlign } from "@material-ui/system";

function ConfigCard({ name, globalState }) {

  const { state } = useContext(Context);

  const useStylesButton = makeStyles({
    root: {
      color: "white",
      backgroundColor: "#3b70b1",
      borderRadius: "15px",
    },
    label: {},
  });

  const classesButton = useStylesButton();


  //CSS styling
  const useStylesCard = makeStyles({
    root: {
      border: " 3px solid black",
      borderRadius: "15px",
      padding:"25px"
    }, // uma regra de estilo
    label: {
      textAlign: "center",
      backgroundColor: "#3b70b1",
      color: "white",
      borderRadius: "15px",
      height:'40px',
      padding: '10px'
    },
    Radio: {
      marginRight: "20px",
    },
    status: {
      fontWeight: "1000",
    } // uma regra de estilo aninhada
  });

  const classesCard = useStylesCard();

  const [value, setValue] = useState(globalState);
  const [clicked, setClicked] = useState(globalState);

  const handleChange = (event) => {
    setValue(event.target.value);
  };

  const handleClick = () => {
    setClicked(value);
    if (clicked === 'emergency'){
      state.emergencyFlag = true;
    }
  };

  return (
    <FormControl component="fieldset">
      <FormLabel component="legend" className={classesCard.label}>
        {name}
      </FormLabel>
      <RadioGroup
        className={classesCard.root}
        aria-label="status"
        name={name}
        value={value}
        onChange={handleChange}
      >
        <p className={classesCard.status}>
          Status: {clicked == "standby" ? "StandBy" : ""}
          {clicked == "emergency" ? "Emergência" : ""}
          {clicked == "evacuation" ? "Evacuação" : ""}
          {clicked == "endEmergency" ? "Fim Emergência" : ""}
        </p>
        <FormControlLabel
          value="standby"
          control={<Radio className={classesCard.Radio} />}
          label="StandBy"
        />
        <FormControlLabel
          value="emergency"
          control={<Radio className={classesCard.Radio} />}
          label="Emergência"
        />
        <FormControlLabel
          value="evacuation"
          control={<Radio className={classesCard.Radio} />}
          label="Evacuação"
        />
        <FormControlLabel
          value="endEmergency"
          control={<Radio className={classesCard.Radio} />}
          label="Fim Emergência"
        />
      </RadioGroup>
      <Button
        className={classesButton.root}
        variant="contained"
        onClick={handleClick}
      >
        Submeter
      </Button>
    </FormControl>
  );
}

export default ConfigCard;
