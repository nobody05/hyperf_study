import React from "react"
import {Col, Row} from "antd";
import Nav from "./Components/Nav";



export default class Admin extends React.Component{

    render() {
        return (
            <Row className="container">
                <Col className="NavBar" span={4}>
                    <Nav />
                </Col>
                <Col className="Content" span={20}>
                    {this.props.children}
                </Col>
            </Row>
        );
    }
}