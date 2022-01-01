import React, { useRef } from "react";

function Loginin(props) {

    const refEmail = useRef(null);
    const refPass = useRef(null);

    const handelLoin = () => {
        const data = {
            "email": refEmail.current.value,
            "pass": refPass.current.value,
        };
        console.log(data)
    }

        return (
          <div>
            <form className="form">
              <label
                className="sr-only"
                htmlFor="inlineFormInputGroupUsername2"
              >
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
              <label
                className="sr-only"
                htmlFor="inlineFormInputGroupPassword2"
              >
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
            </form>
            <button onClick={handelLoin} className="btn mb-2">
              Submit
            </button>
          </div>
        );
    }


export default Loginin;
