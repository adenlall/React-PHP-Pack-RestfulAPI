import React, { useState } from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";

import Home from "./Pages/Home/Home";
import Navbar from "./Pages/Navbar/Navbar";
import Footer from "./Pages/Footer/Footer";

import Signup from "./Pages/Signup/Signup";
import Login from "./Pages/Login/Login";

function App() {
  const [conn, connUp] = useState(false);
  const [log, logUp] = useState(false);

  const setConn = (est) => {
    connUp(est);
  };
  const setLog = (est) => {
    logUp(est);
  };

  return (
    <div className="cover-container container d-flex min-vh-100 h-100 p-3 mx-auto flex-column">
      <Router>
        <Navbar />
        <div style={{ userSelect: "auto;" }}>
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/home" element={<Home />} />
            <Route path="/signup" element={<Signup setConn={setConn} />} />
            <Route path="/login" element={<Login setLog={setLog} />} />
            <Route
              path="/login/from=signup"
              element={
                conn ? <Login setLog={setLog} /> : <Signup setConn={setConn} />
              }
            />
            <Route
              path="/dashboard"
              element={log ? <Home /> : <Login setLog={setLog} />}
            />
          </Routes>
          <Footer />
        </div>
      </Router>
    </div>
  );
}

export default App;
