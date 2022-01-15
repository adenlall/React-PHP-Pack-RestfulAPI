import React, { useState } from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";

import Home from "./Pages/Home/Home";
import Navbar from "./Pages/Navbar/Navbar";
import Footer from "./Pages/Footer/Footer";

import Name from "./Pages/Home/Name";
import City from "./Pages/Home/City";
import Clubs from "./Pages/Home/Clubs";
import News from "./Pages/Home/News";

function App() {
  const [conn, connUp] = useState(false);
  const [city, cityUp] = useState(false);
  const [clubs, clubsUp] = useState(false);
  const [news, newsUp] = useState(false);
  const setConn = (est) => {
    connUp(est);
  };
  const setCity = (est) => {
    cityUp(est);
  };
  const setClubs = (est) => {
    clubsUp(est);
  };
  const setNews = (est) => {
    newsUp(est);
  };

  return (
    <div className="cover-container container d-flex min-vh-100 h-100 p-3 mx-auto flex-column">
      <Router>
        <Navbar />
        <div style={{ userSelect: "auto;" }}>
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/home" element={<Home />} />
            <Route path="/signup/name" element={<Name setConn={setConn} />} />
            <Route
              path="/signup/city"
              element={
                conn ? <City setCity={setCity} /> : <Name setConn={setConn} />
              }
            />
            <Route
              path="/signup/clubs"
              element={
                city ? (
                  <Clubs setClubs={setClubs} />
                ) : (
                  <City setCity={setCity} />
                )
              }
            />
            <Route
              path="/signup/news"
              element={
                clubs ? (
                  <News setNews={setNews} />
                ) : (
                  <Clubs setClubs={setClubs} />
                )
              }
            />
            <Route
              path="/dashboard"
              element={
                news ? <Name setConn={setConn} /> : <News setNews={setNews} />
              }
            />{" "}
          </Routes>
          <Footer />
        </div>
      </Router>
    </div>
  );
}

export default App;
