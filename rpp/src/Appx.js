import React, { useRef } from "react";

const URL_LOGIN =
  "http://localhost/React-Pack/php/jwt-authentication-php/api/register.php";

const getData = async (URL_LOGIN, data) => {
  const rep = await fetch(URL_LOGIN, {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
    },
  });

  //console.log(rep);
  const json = await rep.json();
  return json;
};

function Appx() {

  const refFname = useRef(null);
  const refLname = useRef(null);
  const refEmail = useRef(null);
  const refPass = useRef(null);

  const handelLoin = async () => {
    const data = {
      fname: refFname.current.value,
      lname: refLname.current.value,
      email: refEmail.current.value,
      pass: refPass.current.value,
    };
    console.log(data);
    const data_JSON = await getData(URL_LOGIN, data);
    console.log(data_JSON);
    document.querySelector(".htx").innerHTML = data_JSON.status;
  };

  return (
    <div
      className="position-absolute top-50 start-50 translate-middle"
      style={{ width: "30em" }}
    >
      <form className="form" style={{ textAlign: "initial" }}>
        <label className="sr-only" htmlFor="inlineFormInputGroupUsername2">
          F name
        </label>
        <div className="input-group mb-2 mr-sm-2">
          <div className="input-group-prepend">
            <div className="input-group-text">📧</div>
          </div>
          <input
            type="text"
            className="form-control"
            id="inlineFormInputGroupFname"
            placeholder="first name"
            ref={refFname}
          />
        </div>{" "}
        <label className="sr-only" htmlFor="inlineFormInputGroupUsername2">
          L name
        </label>
        <div className="input-group mb-2 mr-sm-2">
          <div className="input-group-prepend">
            <div className="input-group-text">📧</div>
          </div>
          <input
            type="text"
            className="form-control"
            id="inlineFormInputGroupLname"
            placeholder="last name"
            ref={refLname}
          />
        </div>{" "}
        <label className="sr-only" htmlFor="inlineFormInputGroupUsername2">
          email
        </label>
        <div className="input-group mb-2 mr-sm-2">
          <div className="input-group-prepend">
            <div className="input-group-text">📧</div>
          </div>
          <input
            type="email"
            className="form-control"
            id="inlineFormInputGroupemail"
            placeholder="email"
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
            id="inlineFormInputGrouppass"
            placeholder="Password"
            ref={refPass}
          />
        </div>
        <div className="alert alert-danger">
          <span className="htx"> Insert your data </span>
        </div>
      </form>
      {/*       <NavLink className="nav-link" to="/home">
       */}{" "}
      <button
        onClick={handelLoin}
        className="btn btn-lg btn-info btn-block mb-2"
      >
        Submit
      </button>
      {/*       </NavLink>
       */}{" "}
    </div>
  );
}

export default Appx;
