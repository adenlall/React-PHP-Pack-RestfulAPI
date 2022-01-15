import React, { useRef } from "react";
import Inputs from "./Components/Inputs";

const URL_LOGIN = "http://localhost/React-Pack/php/signup-section/name.php";

const getData = async (url, data) => {
  const rep = await fetch(url, {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
    },
  });

  //console.log(rep);
  const json = await rep.json();
  //console.log(json);

  return json;
};

function Name(props) {
  const refName = useRef(null);
  const refEmail = useRef(null);
  const refPass = useRef(null);
  const refBirthday = useRef(null);

  const handelLoin = async () => {
    const data = {
      name: refName.current.value,
      email: refEmail.current.value,
      password: refPass.current.value,
      birthday: refBirthday.current.value,
    };
    console.log(data);
    const data_JSON = await getData(URL_LOGIN, data);
    console.log(data_JSON);
    console.log("Mmm.... ", data_JSON.status);
    props.setConn(data_JSON.success);
    document.querySelector(".htx").innerHTML = data_JSON.status;
  };

  return (
    <main
      className="position-absolute top-50 start-50 translate-middle"
      style={{ userSelect: "auto" }}
    >
      <form className="form" style={{ textAlign: "initial" }}>
        <label className="sr-only" htmlFor="inlineFormInputGroupUsername2">
          Name
        </label>
        <div className="input-group mb-2 mr-sm-2">
          <div className="input-group-prepend">
            <div className="input-group-text">📧</div>
          </div>
          <input
            type="text"
            className="form-control"
            id="inlineFormInputGroupUsername1"
            placeholder="name"
            ref={refName}
          />
        </div>{" "}
        <label className="sr-only" htmlFor="inlineFormInputGroupUsername2">
          Email
        </label>
        <div className="input-group mb-2 mr-sm-2">
          <div className="input-group-prepend">
            <div className="input-group-text">📧</div>
          </div>
          <input
            type="email"
            className="form-control"
            id="inlineFormInputGroupUsername2"
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
            id="inlineFormInputGroupUsername3"
            placeholder="password"
            ref={refPass}
          />
        </div>
        <label className="sr-only" htmlFor="inlineFormInputGroupPassword2">
          Birhday
        </label>
        <div className="input-group mb-2 mr-sm-2">
          <div className="input-group-prepend">
            <div className="input-group-text">🔒</div>
          </div>
          <input
            type="text"
            className="form-control"
            id="inlineFormInputGroupUsername4"
            placeholder="birhday"
            ref={refBirthday}
          />
        </div>
        <div className="alert alert-danger">
          <span className="htx"> Insert your data </span>
        </div>
        <Inputs event={handelLoin} href="/signup/city" butt="Let's Start" />
      </form>
    </main>
  );
}

export default Name;
