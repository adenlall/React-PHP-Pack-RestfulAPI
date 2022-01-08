import React, { useState } from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Loginin from "./Pages/Login/Login";
import Home from "./Pages/Home/Home";
import Navbar from "./Pages/Navbar/Navbar";
import Footer from "./Pages/Footer/Footer";
import Signup from "./Pages/Signup/Signup";

function App() {
  const [conn, connUp] = useState(false);
  const setConn = (est) => {
    connUp(est);
  };

  return (
    <div className="cover-container container d-flex min-vh-100 h-100 p-3 mx-auto flex-column">
      <Router>
        <Navbar />
        <div style={{ userSelect: "auto;" }}>
          <Routes>
            <Route path="/" element={<Loginin setConn={setConn} />} />
            <Route
              path="/home"
              element={conn ? <Loginin setConn={setConn} /> : <Home />}
            />
            <Route path="/login" element={<Loginin setConn={setConn} />} />
            <Route path="/signup" element={<Signup />} />
          </Routes>
          <Footer />
        </div>
      </Router>
    </div>
  );
}

export default App;
