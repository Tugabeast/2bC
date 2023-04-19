import React, { useEffect, useState, useContext, useRef } from "react";
import axios from "axios";
import Context from "../store/context";
import "../styles/Home.css";
import Grid from "@material-ui/core/Grid";
import Button from "@material-ui/core/Button";
import ButtonGroup from "@material-ui/core/ButtonGroup";
import ArrowDropDownIcon from "@material-ui/icons/ArrowDropDown";
import ClickAwayListener from "@material-ui/core/ClickAwayListener";
import Grow from "@material-ui/core/Grow";
import Paper from "@material-ui/core/Paper";
import Popper from "@material-ui/core/Popper";
import MenuItem from "@material-ui/core/MenuItem";
import MenuList from "@material-ui/core/MenuList";

const options = ["1", "2", "3", "4", "5"];

function InfoCard() {
  const { state } = useContext(Context);
  const temp = parseInt(state.id);
  console.log(typeof temp);

  const [open, setOpen] = useState(false);
  const anchorRef = useRef(null);
  const [selectedIndex, setSelectedIndex] = useState();

  const handleClick = () => {
    console.info(`You clicked ${options[selectedIndex]}`);
  };

  const handleMenuItemClick = (event, index) => {
    setSelectedIndex(index);
    setOpen(false);
  };

  const handleToggle = () => {
    setOpen((prevOpen) => !prevOpen);
  };

  const handleClose = (event) => {
    if (anchorRef.current && anchorRef.current.contains(event.target)) {
      return;
    }

    setOpen(false);
  };

  const [person, setPerson] = useState([]);

  const fectchData = () => {
    axios
      .get("http://localhost/db-meeting-point/workers/readWorkersData.php")
      .then((res) => {
        setPerson(res.data.workers.map((el) => el));
      })
      .catch((err) => {
        console.log(err);
      });
  };

  useEffect(() => {
    fectchData();
  }, []);

  return (
    <>
      <div className="list">
        <table class="content-table">
          <thead>
            <tr>
              <th>Info</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              {/* Filter my list of workers by area */}
              {person
                .filter((worker) => worker.id == state.id)
                .map((filteredWorker) => (
                  <div>
                    <p>Id: {filteredWorker.id}</p>
                    <p>Nome: {filteredWorker.name}</p>
                    <p>Empresa: {filteredWorker.enmpresa}</p>
                    <p>
                      Estado:{" "}
                      {filteredWorker.area == 0 ? (
                        <strong>Fora da Zona de Segurança</strong>
                      ) : (
                        "Zona " + filteredWorker.area
                      )}
                      <Grid container direction="column" alignItems="left">
                        <Grid item xs={12}>
                          <ButtonGroup
                            variant="contained"
                            color="primary"
                            ref={anchorRef}
                            aria-label="split button"
                          >
                            <Button onClick={handleClick}>
                              {options[selectedIndex]}
                            </Button>
                            <Button
                              color="primary"
                              size="small"
                              aria-controls={
                                open ? "split-button-menu" : undefined
                              }
                              aria-expanded={open ? "true" : undefined}
                              aria-label="select merge strategy"
                              aria-haspopup="menu"
                              onClick={handleToggle}
                            >
                              <ArrowDropDownIcon />
                            </Button>
                          </ButtonGroup>
                          <Popper
                            open={open}
                            anchorEl={anchorRef.current}
                            role={undefined}
                            transition
                            disablePortal
                          >
                            {({ TransitionProps, placement }) => (
                              <Grow
                                {...TransitionProps}
                                style={{
                                  transformOrigin:
                                    placement === "bottom"
                                      ? "center top"
                                      : "center bottom",
                                }}
                              >
                                <Paper>
                                  <ClickAwayListener onClickAway={handleClose}>
                                    <MenuList id="split-button-menu">
                                      {options.map((option, index) => (
                                        <MenuItem
                                          key={option}
                                          disabled={index === filteredWorker.id}
                                          selected={index === selectedIndex}
                                          onClick={(event) =>
                                            handleMenuItemClick(event, index)
                                          }
                                        >
                                          {option}
                                        </MenuItem>
                                      ))}
                                    </MenuList>
                                  </ClickAwayListener>
                                </Paper>
                              </Grow>
                            )}
                          </Popper>
                        </Grid>
                      </Grid>{" "}
                    </p>{" "}
                    <Button class="btn">Submeter</Button>
                  </div>
                ))}
            </tr>
          </tbody>
        </table>
      </div>
    </>
  );
}

export default InfoCard;
