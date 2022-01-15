import React, { useRef } from "react";
import Inputs from "./Components/Inputs";

const URL_LOGIN = "http://localhost/React-Pack/php/signup-section/city.php";

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

function City(props) {
  const refCity = useRef(null);
  const refCountry = useRef(null);

  const handelLoin = async () => {
    const data = {
      country: refCountry.current.value,
      city: refCity.current.value,
    };
    console.log(data);
    const data_JSON = await getData(URL_LOGIN, data);
    console.log(data_JSON);
    console.log("Mmm.... ", data_JSON.status);
    props.setCity(data_JSON.success);
    document.querySelector(".htx").innerHTML = data_JSON.status;
  };

  return (
    <main
      className="position-absolute top-50 start-50 translate-middle"
      style={{ userSelect: "auto" }}
    >
      <form className="form" style={{ textAlign: "initial" }}>
        <label className="sr-only" htmlFor="inlineFormInputGroupUsername2">
          Country
        </label>
        <div className="input-group mb-2 mr-sm-2">
          <div className="input-group-prepend">
            <div className="input-group-text">🌍</div>
          </div>
          <input
            type="text"
            className="form-control"
            id="inlineFormInputGroupUsername2"
            placeholder="Country"
            ref={refCity}
          />
        </div>{" "}
        <label className="sr-only" htmlFor="inlineFormInputGroupUsername2">
          City
        </label>
        <div className="input-group mb-2 mr-sm-2">
          <div className="input-group-prepend">
            <div className="input-group-text">🌍</div>
          </div>
          <input
            type="text"
            className="form-control"
            id="inlineFormInputGroupUsername2"
            placeholder="City"
            ref={refCountry}
          />
        </div>
        <div className="alert alert-danger">
          <span className="htx"> Insert your Country and City Names </span>
        </div>
        <Inputs event={handelLoin} href="/signup/clubs" butt="Let's Start" />
      </form>
    </main>
  );
}

export default City;
