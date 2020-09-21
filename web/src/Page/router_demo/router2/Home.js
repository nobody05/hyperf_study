import React from 'react';
import { HashRouter, Route, Link, Switch } from 'react-router-dom';


export default class Home extends React.Component
{
    render() {
        return (
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

                    {this.props.children}
                </div>

        );
    }

}