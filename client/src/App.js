import './App.css';
import Login from "./components/Login";
import Logout from "./components/Logout";
import Register from "./components/Register";

function App() {
  return (
    <div className="App">
      <Register />
      <Login />
      <Logout />
    </div>
  );
}

export default App;
