import React from 'react'
import {HashRouter as Router, Route} from 'react-router-dom'
import Main from "../router1/Main";
import Topic from "../router1/Topic";
import About from "../router1/About";
import Home from "./Home";


export default class IRoute extends React.Component {

    render() {
        return (
            <Router>
                <Home>
                    <Route exact={true} path="/main" component={Main}></Route>
                    <Route path="/topic" component={Topic}></Route>
                    <Route path="/about" component={About}></Route>
                </Home>

            </Router>
        );
    }
}