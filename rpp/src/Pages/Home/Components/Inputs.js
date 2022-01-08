import React, { Component } from "react";
import { NavLink } from "react-router-dom";

class Inputs extends Component {
  render() {
    return (
      <p className="lead" style={{ userSelect: "auto" }}>
        <NavLink
          className="btn btn-lg btn-secondary fw-bold border-white bg-white text-dark"
          to={this.props.href}
        >
          {this.props.butt}
        </NavLink>
      </p>
    );
  }
}

export default Inputs;
