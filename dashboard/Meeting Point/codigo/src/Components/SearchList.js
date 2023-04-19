import React, { useState, useContext } from "react";
import { Link } from "react-router-dom";
import Context from "../store/context";
import "../styles/SearchList.css";
import TextField from "@material-ui/core/TextField";
import { makeStyles } from "@material-ui/core/styles";

import InputAdornment from "@material-ui/core/InputAdornment";
import SearchIcon from "@material-ui/icons/Search";

function SearchList({ search }) {
  const useStylesInput = makeStyles((theme) => ({
    margin: {
      margin: theme.spacing(1),
    },
  }));

  const classes = useStylesInput();

  const { state } = useContext(Context);

  const name = "Nome";
  const id = "Id";
  const area = "Area";

  const [statusName, setStatusName] = useState(name);

  const [input, setInput] = useState("");

  const searchBy = (props) => {
    if (props == 1) {
      setStatusName(id);
    }
    if (props == 2) {
      setStatusName(name);
    }
    if (props == 3) {
      setStatusName(area);
    }
  };

  const handleChange = (e) => {
    e.preventDefault();
    setInput(e.target.value);
  };

  function searchEngine(props) {
    if (input.length > 0) {
      search = search.filter((i) => {
        if (props === id) {
          return i.id.match(input);
        }
        if (props === name) {
          return i.name.toLowerCase().match(input);
        }
        if (props === area) {
          return i.area.match(input);
        }
      });
    }
  }

  return (
    <div className="search">
      {/* Show List */}

      <div class="table" onChange={searchEngine(statusName)}>
        <div class="row header">
          <div class="cell-index">Nome</div>
          <div class="cell-index">Empresa</div>
        </div>
        <scroll-container>
          <div class="row">
            <div class="cell" data-title="Name">
              {search
                .sort((a, b) => a.name.localeCompare(b.name))
                .map((worker) => {
                  return (
                    <p
                      className={
                        worker.area == 0 ? "text-not-safe" : "text-safe"
                      }
                      onClick={() => {
                        state.id = worker.id;
                      }}
                    >
                      {" "}
                      {worker.area == 0 ? (
                        <Link to="/infoCard" style={{ color: "inherit" }}>
                          {worker.name}
                        </Link>
                      ) : (
                        <p>{worker.name}</p>
                      )}
                    </p>
                  );
                })}
            </div>

            <div class="cell" data-title="company">
              {search.map((worker) => {
                return (
                  <p
                    className={worker.area == 0 ? "text-not-safe" : "text-safe"}
                  >
                    {worker.enmpresa}
                  </p>
                );
              })}
            </div>
          </div>
        </scroll-container>
      </div>

      <TextField
        className={classes.margin}
        placeholder={statusName}
        onChange={handleChange}
        value={input}
        id="input-with-icon-textfield"
        label="Pesquisa"
        InputProps={{
          startAdornment: (
            <InputAdornment position="start">
              <SearchIcon />
            </InputAdornment>
          ),
        }}
      />
    </div>
  );
}

export default SearchList;
