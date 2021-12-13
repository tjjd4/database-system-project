import './home.css';
import NavBar from '../components/navbar';
import React from 'react';
import { Col, Image } from 'react-bootstrap';
import specialtyMap from '../image/specialtyMap.png';

class Home extends React.Component {
  render() {
    return (
      <div className="Home">
        <NavBar />
          <header className="App-header">
              <Image src={specialtyMap} roundedCircle />
          </header>
      </div>
    );
  }
}

export default Home;