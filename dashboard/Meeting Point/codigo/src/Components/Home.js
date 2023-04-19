import React, { useState, useEffect, useContext } from "react";
import Context from "../store/context";
import "../styles/Home.css";
import "../styles/Button.css";

import axios from "axios";
import "../styles/Search.css";

import CardArea from "./CardArea";
import ConfigArea from "./ConfigCard";

import SearchList from "./SearchList";
import "../styles/CardArea.css";

import ProgressBar from "./ProgressBar";

function Home() {
  const { state } = useContext(Context);
  //Hook for Fetching
  const [person, setPerson] = useState([]);
  const [emergencyState, setEmergencyState] = useState(10000);

  //First fetch Data
  const fectchData = async () => {
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

  // Fecth Data & Timer to fetch the data from Database
  useEffect(() => {
    let isMounted = true;

    const timer = setInterval(() => {
      const fectchDataTimer = async () => {
        try {
          const url =
            "http://localhost/db-meeting-point/workers/readWorkersData.php";
          const res = await axios.get(url);

          if (isMounted) {
            setPerson(res.data.workers.map((el) => el));
          }
        } catch (error) {
          console.log(error);
        }
      };
      fectchDataTimer();
    }, emergencyState);
    return () => {
      isMounted = false;
      clearInterval(timer);
    };
  }, [emergencyState]);

  useEffect(() => {
    if (state.emergencyFlag) {
      setEmergencyState(5000);
    }
  });

  //Variable for filter the data from DB by Area

  const area1 = person.filter((worker) => worker.area == 1);
  const area2 = person.filter((worker) => worker.area == 2);
  const area3 = person.filter((worker) => worker.area == 3);
  const area4 = person.filter((worker) => worker.area == 4);
  const area5 = person.filter((worker) => worker.area == 5);

  //Variable to store Data from fectch and to use for Search Engine
  let searchTemp = person;

  return (
    <div className="home-open">
      {" "}
      <div className="progresBar">
        <ProgressBar
          safe={
            area1.length +
            area2.length +
            area3.length +
            area4.length +
            area5.length
          }
          notSafe={person.length}
        />
      </div>
      {/* Show search box*/}
      <div className="search">
        {/* Search and Show List */}
        <SearchList search={searchTemp} />
      </div>
      {/*Testing wirh useContext */}
      <div className="config">
        <h1>Configuração</h1>
        <div className="box-config">
          <ConfigArea name={"MP_1"} globalState={state.buttonRadio.radio1} />
          <ConfigArea name={"MP_2"} globalState={state.buttonRadio.radio2} />
          <ConfigArea name={"MP_3"} globalState={state.buttonRadio.radio3} />
          <ConfigArea name={"MP_4"} globalState={state.buttonRadio.radio4} />
          <ConfigArea
            name={"Brigadistas"}
            globalState={state.buttonRadio.radio5}
          />
        </div>
      </div>
      {/* Show Cards */}
      <div>
        <h1>Zonas Ponta de Encontro</h1>
        <div className="cards">
          {/*Render my Card Component*/}
          <div className="card">
            <CardArea area={area1} props={1} name={"MP_1"} />
          </div>

          <div className="card">
            <CardArea area={area2} props={2} name={"MP_2"} />
          </div>

          <div className="card">
            <CardArea area={area3} props={3} name={"MP_3"} />
          </div>

          <div className="card">
            <CardArea area={area4} props={4} name={"MP_4"} />
          </div>

          <div className="card">
            <CardArea area={area5} props={5} name={"Brigadistas"} />
          </div>
        </div>
      </div>
    </div>
  );
}

export default Home;
