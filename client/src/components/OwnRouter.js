import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Home from '../pages/home';
import Login from '../pages/login';

const OwnRouter = () => {
    return (
    <div>
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<Home/>}/>
                <Route path="/pages/login" element={<Login/>}/>
            </Routes>
        </BrowserRouter>
    </div>
    );
}

export default OwnRouter;