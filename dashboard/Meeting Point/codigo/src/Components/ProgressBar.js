import React from "react";
import "../styles/ProgressBar.css";

function ProgressBar({ safe, notSafe }) {
  const percentage = (safe * 100) / notSafe;

  const statusSafe = {
    opacity: "1",
    width: `${percentage}%`,
    backgroundColor: "green",
  };

  const statusNotSafe = {
    width: "100%",
    backgroundColor: "red",
    height: "45px",
    border: '5px solid'
  };

  return (
    <div className="progressBar">
      <p className="text-progressbar">
      
        {safe} / {notSafe}
      </p>

      <div class="progress" style={statusNotSafe}>
        <div style={statusSafe}></div>
      </div>
    </div>
  );
}

export default ProgressBar;
