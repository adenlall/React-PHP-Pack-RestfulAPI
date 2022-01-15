import axios from "axios";
const SERVER_URL = "http://localhost/React-Pack/php/jwt-authentication-php";

const login = async (data) => {
  const LOGIN_ENDPOINT = `${SERVER_URL}/api/login.php`;

  try {
    const response = await fetch(LOGIN_ENDPOINT, {
      method: "POST",
      body: JSON.stringify(data),
      headers: {
        "Content-Type": "application/json",
      },
    });

    if (
      response.status === 200 &&
      response.data.jwt &&
      response.data.expireAt
    ) {
      let jwt = response.data.jwt;
      let expire_at = response.data.expireAt;

      localStorage.setItem("access_token", jwt);
      localStorage.setItem("expire_at", expire_at);
    }
  } catch (e) {
    console.log(e);
  }
};
const register = async (data) => {
  const SIGNUP_ENDPOINT = `${SERVER_URL}/api/register.php`;
  const response = await fetch(SIGNUP_ENDPOINT, {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
    },
  });

  const json = await response.json();
  console.log(json);
};

const logout = () => {
  localStorage.removeItem("access_token");
  localStorage.removeItem("expire_at");
};

export { login, register, logout };
