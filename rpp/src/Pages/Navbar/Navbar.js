import React, { Component } from "react";
import Logo from "./Components/Logo";
import Navigators from "./Components/Navigators";

class Navbar extends Component {
  render() {
    return (
      <header className="mb-auto" style={{ userSelect: "auto" }}>
        <div style={{ userSelect: "auto" }}>
          <Logo title="Adenlall" />
          <Navigators bgColor1="rgb(79 159 207)" bgColor2="" bgColor3="" />
        </div>
      </header>
    );
  }
}

export default Navbar;
