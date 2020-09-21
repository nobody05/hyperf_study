import React from "react"
import {HashRouter, Route, Switch}  from "react-router-dom"
import App from "./App"
import UserList from "./Page/UserList";
import DownloadCenter from "./Page/DownloadCenter";
import Admin from "./admin";

export default class IRouter extends React.Component{

    render() {
        return (
            <HashRouter>
                <App>
                    <Switch>
                        <Route path="/" render={()=>
                            <Admin>
                                <Switch>
                                    <Route path="/admin" component={Admin}></Route>
                                    <Route path="/userList" component={UserList}></Route>
                                    <Route path="/downloadCenter" component={DownloadCenter}></Route>
                                </Switch>
                            </Admin>
                        }></Route>
                    </Switch>


                </App>
            </HashRouter>
        );
    }
}