import React from 'react';
import ReactDOM from 'react-dom';

import App from './App';


import Context from './store/context';
import useGlobalStore from './store/useGlobalState';


const Index = () => {
  const store = useGlobalStore();
  return (
    <Context.Provider value={store}>
      <App />
    </Context.Provider>
  )
}

ReactDOM.render(
  <React.StrictMode>
    <Index />
  </React.StrictMode>,
  document.getElementById('root')
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA

