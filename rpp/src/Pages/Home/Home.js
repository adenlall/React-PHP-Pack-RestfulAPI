import React, { Component } from "react";
import Header from "./Components/Header";
import Info from "./Components/Info";
import Inputs from "./Components/Inputs";

class Home extends Component {
  render() {
    return (
      <main
        className="position-absolute top-50 start-50 translate-middle"
        style={{ userSelect: "auto" }}
      >
        <Header title="Cover your page." />
        <Info
          info="Cover is a one-page template for building simple and beautiful home
            pages. Download, edit the text, and add your own fullscreen
            background photo to make it your own."
        />
        <Inputs href="/" butt="Let's Start" />
      </main>
    );
  }
}

export default Home;
