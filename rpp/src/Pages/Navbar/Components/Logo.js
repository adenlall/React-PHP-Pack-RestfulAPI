import React, { Component } from "react";


class Logo extends Component {
  render() {
    return (
        <h3 className="float-md-start mb-0" style={{ userSelect: "auto" }}>
          {this.props.title}
        </h3>
    );
  }
}

export default Logo;
