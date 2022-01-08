import React, { Component } from "react";

class Info extends Component{
  render() {
    return (
        <p className="lead" style={{ userSelect: "auto;" }}>
          {this.props.info}
        </p>
    );
  }
}

export default Info;
