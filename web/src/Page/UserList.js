import React from "react"
import axios from "../Axios"
import {Table, Modal, Form, Input, Button} from "antd";

const columns = [
    {
        title:"ID",
        dataIndex:"id",
        key:"id",

    },
    {
        title: '昵称',
        dataIndex: 'nickname',
        key: 'nickname',
        render: text => <a>{text}</a>,
    },
    {
        title: '省份',
        dataIndex: 'province',
        key: 'province',
    },
    {
        title: '城市',
        dataIndex: 'city',
        key: 'city',
    }
];




class UserList extends React.Component {

    constructor(props){
        super(props)
    }

    state = {
        list:[],
        columns:[],
        pageTotal:0,
        pageCurrent:1,
        pagePer:30,

    };

    componentWillMount() {


        axios.ajax({url:"excel/userList", method:"get"}).then((res) => {
            if (res.code === 1000) {
                this.setState({
                    list:res.data.list,
                    columns:columns,
                    pageTotal:res.data.total,
                    pageCurrent:res.data.page,
                    pagePer:res.data.pageSize,
                })
            } else {
                Modal.info({
                    title:"错误",
                    content:res.message
                })
            }

            console.log(res)
        })
    }

    search = (page = 1, pageSize = 30) => {
        console.log(this.refs.UserForm.getFieldsValue())

        let minId = this.refs.UserForm.getFieldsValue().minId
        let maxId = this.refs.UserForm.getFieldsValue().maxId

        axios.ajax({url:"excel/userList?minId="+ minId + "&maxId=" + maxId + "&page="+ page + "&pageSize="+ pageSize, method: "get"}).then(
            (res) => {
                if (res.code === 1000) {
                    this.setState({
                        list:res.data.list,
                        columns:columns,
                        pageTotal:res.data.total,
                        pageCurrent:res.data.page,
                        pagePer:res.data.pageSize,
                    })
                } else {
                    Modal.info({
                        title:"错误",
                        content:res.message
                    })
                }

                console.log(res)
            }
        )
    };

    export = () => {
        console.log(this.refs.UserForm.getFieldsValue())

        let minId = this.refs.UserForm.getFieldsValue().minId
        let maxId = this.refs.UserForm.getFieldsValue().maxId

        axios.ajax({url:"excel/export?minId="+ minId + "&maxId=" + maxId, method: "get"}).then(
            (res) => {
                if (res.code === 1000) {
                    Modal.success({
                        content: res.msg
                    })
                } else {
                    Modal.info({
                        title:"错误",
                        content:res.message
                    })
                }

                console.log(res)
            }
        )
    };


    render() {
        return (
            <div>
                <Form size="small" layout="inline" ref="UserForm">
                    <Form.Item label="ID最小值" name="minId">
                        <Input name="minId" />
                    </Form.Item>
                    <Form.Item label="ID最大值" name="maxId">
                        <Input name="maxId" />
                    </Form.Item>
                    <Form.Item>
                        <Button type="primary" onClick={this.search}>搜索</Button>
                    </Form.Item>
                    <Form.Item>
                        <Button type="default" onClick={this.export}>导出</Button>
                    </Form.Item>
                </Form>
                <Table columns={this.state.columns} dataSource={this.state.list}
                       pagination={{
                           pageSize:this.state.pagePer,
                           total:this.state.pageTotal,
                           current:this.state.pageCurrent,
                           onChange: (current, pageSize) => this.search(current, pageSize)
                       }}
                />
            </div>
        );
    }
}
export default UserList