import React, { useRef } from "react";
import Inputs from "./Components/Inputs";

const URL_LOGIN = "http://localhost/React-Pack/php/signup-section/news.php";

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

function News(props) {
  const refNews = useRef(null);

  const handelLoin = async () => {
    const data = {
      news: refNews.current.value,
    };
    console.log(data);
    const data_JSON = await getData(URL_LOGIN, data);
    console.log("Mmm.... ", data_JSON.conectado);
    props.setNews(data_JSON.conectado);
    document.querySelector(".htx").innerHTML = data_JSON.error;
  };

  return (
    <main
      className="position-absolute top-50 start-50 translate-middle"
      style={{ userSelect: "auto" }}
    >
      <form className="form" style={{ textAlign: "initial" }}>
        <label className="sr-only" htmlFor="inlineFormInputGroupUsername2">
          Intrested Topics
        </label>
        <div className="input-group mb-2 mr-sm-2">
          <div className="input-group-prepend">
            <div className="input-group-text">🌍</div>
          </div>
          <input
            type="text"
            className="form-control"
            id="inlineFormInputGroupUsername2"
            placeholder="<Topic one>, <Topic two> ..."
            ref={refNews}
          />
        </div>
        <div className="alert alert-danger">
          <span className="htx"> Insert your data </span>
        </div>
        <Inputs
          event={handelLoin}
          href="/signup/dashboard"
          butt="Let's Start"
        />
      </form>
    </main>
  );
}

export default News;
