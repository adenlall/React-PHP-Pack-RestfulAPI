import React, { useRef } from "react";
import { NavLink } from "react-router-dom";

const URL_LOGIN =
  "http://localhost/React-Pack/php/jwt-authentication-php/api/login.php";

const getData = async (URL_LOGIN, data) => {
  const rep = await fetch(URL_LOGIN, {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
    },
  });
  const json = await rep.json();
  //console.log(json);

  return json;
};

function Loginin(props) {
  const refEmail = useRef(null);
  const refPass = useRef(null);

  const handelLoin = async () => {
    const data = {
      email: refEmail.current.value,
      pass: refPass.current.value,
    };
    console.log(data);
    const data_JSON = await getData(URL_LOGIN, data);
    console.log(data_JSON);
    document.querySelector(".htx").innerHTML = data_JSON.message;
    /*     props.setConn(false);
     */
  };

  return (
    <div
      className="position-absolute top-50 start-50 translate-middle"
      style={{ width: "30em" }}
    >
      <form className="form" style={{ textAlign: "initial" }}>
        <label className="sr-only" htmlFor="inlineFormInputGroupUsername2">
          Username
        </label>
        <div className="input-group mb-2 mr-sm-2">
          <div className="input-group-prepend">
            <div className="input-group-text">📧</div>
          </div>
          <input
            type="email"
            className="form-control"
            id="inlineFormInputGroupUsername2"
            placeholder="Username"
            ref={refEmail}
          />
        </div>{" "}
        <label className="sr-only" htmlFor="inlineFormInputGroupPassword2">
          Password
        </label>
        <div className="input-group mb-2 mr-sm-2">
          <div className="input-group-prepend">
            <div className="input-group-text">🔒</div>
          </div>
          <input
            type="password"
            className="form-control"
            id="inlineFormInputGroupUsername2"
            placeholder="Password"
            ref={refPass}
          />
        </div>
        <div className="alert alert-danger">
          <span className="htx"> Insert your data </span>
        </div>
      </form>
      <NavLink className="nav-link" to="/dashboard">
        <button
          onClick={handelLoin}
          className="btn btn-lg btn-info btn-block mb-2"
        >
          Submit
        </button>
      </NavLink>
    </div>
  );
}

export default Loginin;
