import axios from "axios";
const SERVER_URL = "http://localhost/React-Pack/jwt-authentication-php";

const login = async (data) => {
  const LOGIN_ENDPOINT = `${SERVER_URL}/api/login.php`;

  try {
    let response = await axios.post(LOGIN_ENDPOINT, data);

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

/*  const SIGNUP_ENDPOINT = `${SERVER_URL}/api/register.php`;
 axios
   .post(SIGNUP_ENDPOINT, data)
   .then((res) => console.log(res.data))
   .catch((error) => {
     console.log("error: X");
     console.log(error.response);
   }); */
const register = async (data) => {
  const SIGNUP_ENDPOINT = `${SERVER_URL}/api/register.php`;

  const rep = await fetch(SIGNUP_ENDPOINT, data);
  const json = await rep.json();
  console.log(json);
};

const logout = () => {
  localStorage.removeItem("access_token");
  localStorage.removeItem("expire_at");
};

export { login, register, logout };
