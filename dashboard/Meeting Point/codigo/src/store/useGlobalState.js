import { useState, useEffect } from "react";

const useGlobalStore = () => {
  const [state, setState] = useState({
    listEvent: 1,
    id: 0,
    buttonRadio: {
      radio1: "standby",
      radio2: "standby",
      radio3: "standby",
      radio4: "standby",
      radio5: "standby",
    },
    emergencyFlag: false
  });

  const actions = (action) => {
    const { type, payload } = action;
    switch (type) {
      case "setState":
        return setState(payload);
      default:
        return state;
    }
  };
  return { state, actions };
};

export default useGlobalStore;
