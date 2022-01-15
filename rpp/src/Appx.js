import React, { Component } from "react";
import { login, register, logout } from "./core/JWTAuth";

class Appx extends Component {
  async login() {
    let info = {
      email: "aden@lall.com",
      password: "OX00.comOXOX..x",
    };

    await login(info);
  }
  async register() {
    let data = {
      first_name: "Bilal",
      last_name: "Janah",
      email: "aden@lall.com",
      password: "OX00.comOXOX..x",
    };

    await register(data);
  }
  render() {
    return (
      <div className="container">
        <div className="row">
          <h1>React JWT Authentication Example</h1>

          <button className="btn btn-primary" onClick={this.register}>
            Sign up
          </button>

          <button className="btn btn-primary" onClick={this.login}>
            Log in
          </button>

          <button className="btn btn-primary" onClick={logout}>
            Log out
          </button>
        </div>
      </div>
    );
  }
}

export default Appx;
