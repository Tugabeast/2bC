import React from 'react';

import './App.css';
import NavBar from './Components/NavBar'
import {BrowserRouter as Router, Switch, Route} from 'react-router-dom';
import Home from './Components/Home';


import Footer from './Components/Footer'
import List from './Components/List'

import InfoCard from './Components/InfoCard';




function App() {
  return (
    <>
    <Router>
        <NavBar />
         <Switch>
          <Route path='/' exact component={Home} />
          <Route path='/workers' component={List} />
          <Route path='/infoCard' component={InfoCard} />
        </Switch>
      </Router>
      <Footer />
      
    </>
  );
}

export default App;
