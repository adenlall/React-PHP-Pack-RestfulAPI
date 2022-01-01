import { Provider } from "../Context";
import Form from "../Form/Form";
import UserList from "../components/UserList";
import { Actions } from "../Actions";

function Singuppack() {
  const data = Actions();
  return (
    <Provider value={data}>
      <div className="App">
        <h1>React JS + PHP CRUD Application</h1>
        <div className="wrapper">
          <section className="left-side">
            <Form />
          </section>
          <section className="right-side">
            <UserList />
          </section>
        </div>
      </div>
    </Provider>
  );
}

export default Singuppack;
