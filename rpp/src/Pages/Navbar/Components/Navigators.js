import React, { Component } from "react";
import { NavLink } from "react-router-dom";

class Navigators extends Component {
  render() {
    return (
      <nav
        className="nav nav-masthead justify-content-center float-md-end"
        style={{ userSelect: "auto" }}
      >
        <NavLink className="nav-link" to="/home">
          <span
            class="badge text-light"
            style={{ fontSize: "16px", backgroundColor: this.props.bgColor1 }}
          >
            Home
          </span>
        </NavLink>
        <NavLink className="nav-link" to="/features">
          <span
            class="badge text-light"
            style={{ fontSize: "16px", backgroundColor: this.props.bgColor2 }}
          >
            Features{" "}
          </span>
        </NavLink>

        <NavLink className="nav-link" to="/contact">
          {" "}
          <span
            class="badge text-light"
            style={{ fontSize: "16px", backgroundColor: this.props.bgColor3 }}
          >
            Contact
          </span>
        </NavLink>

        <NavLink className="nav-link" to="/Login">
          {" "}
          <span
            class="badge text-dark"
            style={{ fontSize: "16px", backgroundColor: "white" }}
          >
            Login
          </span>
        </NavLink>
        <NavLink className="nav-link" to="/Signup">
          {" "}
          <span
            class="badge text-dark"
            style={{ fontSize: "16px", backgroundColor: "white" }}
          >
            Sign-up
          </span>
        </NavLink>
      </nav>
    );
  }
}

export default Navigators;
