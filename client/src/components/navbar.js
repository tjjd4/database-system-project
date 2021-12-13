import React from 'react';
import './navbar.css';
import { Navbar, Container, Nav, NavDropdown } from 'react-bootstrap';
import Shopee from '../image/shopee.png';


const NavBar = () => {
  return (
    <Navbar bg="light" expand="lg">
      <Container>
        <Navbar.Brand href="#home">
        <img
            src={Shopee}
            width="30"
            height="30"
            alt="logo"
          />
          名產配送平台
        </Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <Nav className="me-auto">
            <Nav.Link href="#home">首頁</Nav.Link>
            <Nav.Link href="#link">商品</Nav.Link>
            <NavDropdown title="會員專區" id="basic-nav-dropdown">
              <NavDropdown.Item href="#action/3.1">個人資料</NavDropdown.Item>
              <NavDropdown.Item href="#action/3.2">訂單狀況</NavDropdown.Item>
              <NavDropdown.Item href="#action/3.3">黑名單</NavDropdown.Item>
              <NavDropdown.Divider />
              <NavDropdown.Item href="#action/3.4">聊天室</NavDropdown.Item>
            </NavDropdown>
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
    );
  }
  export default NavBar;