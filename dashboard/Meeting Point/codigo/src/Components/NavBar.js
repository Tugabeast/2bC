import React, { useState, useContext } from "react";
import { Link } from "react-router-dom";
import { SidebarData } from "./SideBarData";
import "../styles/NavBar.css";
import { IconContext } from "react-icons";
import * as GrIcons from "react-icons/gr";

function NavBar() {
  return (
    <IconContext.Provider value={{ color: "white", size: "30px" }}>
      <div className="navbar">
        <div className="menu-bars">
          <GrIcons.GrLocation />
        </div>
      </div>

      <nav className="nav-menu">
        <p className="nav-menu-items" onClick={(e)=> {
          e.preventDefault();
        }}>
          {SidebarData.map((item, index) => {
            return (
              <div key={index} className={item.cName}>
                <Link to={item.path}>
                  <div className="menu-icon-text">
                    <span className="menu-icon">{item.icon}</span>
                    <span className="menu-text">{item.title}</span>
                  </div>
                </Link>
              </div>
            );
          })}
        </p>
      </nav>
    </IconContext.Provider>
  );
}

export default NavBar;
