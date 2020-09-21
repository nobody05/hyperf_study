import React from 'react';
import { HashRouter, Route, Link, Switch } from 'react-router-dom';
import Main from './Main';
import Topic from './Topic';
import About from './About';


export default class Home extends React.Component
{
    render() {
        return (
            <HashRouter>
                <div>
                    <ul>
                        <li><Link to="/main">Home</Link></li>
                    </ul>
                    <ul>
                        <li><Link to="/topic">Top</Link></li>
                    </ul>
                    <ul>
                        <li><Link to="/about">About</Link></li>
                    </ul>
                </div>


                <Switch>
                    {/**/}
                    <Route exact={true} path="/main" component={Main}></Route>
                    <Route path="/topic" component={Topic}></Route>
                    <Route path="/about" component={About}></Route>
                </Switch>

            </HashRouter>

        );
    }

}