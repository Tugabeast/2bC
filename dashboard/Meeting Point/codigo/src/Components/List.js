import React, { useContext, useState, useEffect } from "react";
import "../styles/List.css";
import Context from "../store/context";
import axios from "axios";
import {
  Paper,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TablePagination,
  TableRow,
} from "@material-ui/core";
import { makeStyles } from "@material-ui/core/styles";
import * as BsIcons from "react-icons/bs";
import { Link } from "react-router-dom";

function List() {
  const useStyles = makeStyles({
    root: {
      width: "100%",
      borderRadius: 5,
    },
    container: {
      maxHeight: 250,
      maxWidth: 700,
    },
  });

  const classes = useStyles();

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

  const { state } = useContext(Context);

  const areaList =
    state.listEvent === 0 ? "Fora da Zona Segura" : state.listEvent;

  return (
    <div className="list">
      <Paper className={classes.root}>
        <TableContainer className={classes.container}>
          <Table stickyHeader aria-label="sticky table">
            <TableHead>
              <TableRow>
                <div>
                  <TableCell className="column-name">
                    {areaList === 5 ? "Brigadistas" : "MP_" + areaList}
                  </TableCell>
                </div>
              </TableRow>
            </TableHead>
            <TableBody>
              {person
                .filter((worker) => worker.area == state.listEvent).sort((a, b) => a.name.localeCompare(b.name))
                .map((filteredWorker) => {
                  return (
                    <TableRow
                      hover
                      role="checkbox"
                      tabIndex={-1}
                      key={filteredWorker.id}
                    >
                      <div>
                        <TableCell className="column-name">
                          {filteredWorker.name}
                        </TableCell>
                        <TableCell className="column-company">
                          {filteredWorker.enmpresa}
                        </TableCell>
                      </div>
                    </TableRow>
                  );
                }
                )}
            </TableBody>
          </Table>
        </TableContainer>
      </Paper>
    </div>
  );
}

export default List;
