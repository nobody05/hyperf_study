import React from 'react';
import { Menu, Button } from 'antd';
import {
    AppstoreOutlined,
    MenuUnfoldOutlined,
    MenuFoldOutlined,
    PieChartOutlined,
    DesktopOutlined,
    ContainerOutlined,
    MailOutlined,
} from '@ant-design/icons';

import menuList from './MenuList';
import {NavLink} from "react-router-dom"
const { SubMenu } = Menu;

export default class NavBar extends React.Component
{
    state = {
        collapsed: false,
    };

    renderMenu = (data) => {
        return data.map((item) => {
            if (item.children) {
                return <SubMenu key={item.key} title={item.title}>{this.renderMenu(item.children)}</SubMenu>
            }
            return <Menu.Item key={item.key} > <NavLink to={item.key}>{item.title}</NavLink></Menu.Item>
        })
    };

    componentWillMount() {
        const menuTree = this.renderMenu(menuList);
        this.setState({
            menuTree
        })
    }

    toggleCollapsed = () => {
        this.setState({
            collapsed: !this.state.collapsed,
        });
    };

    render() {
        return (
            <div style={{ width: 256 }}>
                <Button type="primary" onClick={this.toggleCollapsed} style={{ marginBottom: 16 }}>
                    {React.createElement(this.state.collapsed ? MenuUnfoldOutlined : MenuFoldOutlined)}
                </Button>

                <Menu
                    defaultSelectedKeys={['1']}
                    defaultOpenKeys={['sub1']}
                    mode="inline"
                    theme="dark"
                    inlineCollapsed={this.state.collapsed}
                >
                    {this.state.menuTree}
                </Menu>
            </div>
        );
    }

}
