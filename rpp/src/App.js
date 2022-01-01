import React, { useState } from "react";
import Loginin from "./components/Login/Login";
import Test from "./components/Test";

function App() {
  const [conn, connUp] = useState(false);
  const setConn = (est) => {
    connUp(est);
  }

  return conn ? <Test /> : <Loginin setConn={setConn} />;
}

export default App;
