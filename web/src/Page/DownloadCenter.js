import React from "react"
import {Table, Tag, Space} from "antd";
import axios from "../Axios"


const columns = [
    {
        title:"ID",
        dataIndex:"id",
        key:"id",

    },
    {
        title: '创建用户',
        dataIndex: 'created_user_id',
        key: 'created_user_id',
    },
    {
        title: '文件路径',
        dataIndex: 'export_file_path',
        key: 'export_file_path',
    },
    {
        title: '状态',
        dataIndex: 'status',
        key: 'status',
    },
    {
        title: 'Action',
        dataIndex: '',
        key: 'x',
        render: (text, record) => (<a href={"http://127.0.0.1:9501"+ record.export_file_path} >下载</a>),
    }
];

export default class DownloadCenter extends React.Component {
    state = {
        list:[],
        columns:[]

    }

    componentWillMount() {


        axios.ajax({url:"excel/downloadCenter", method:"get"}).then((res) => {
            this.setState({
                list:res.data.list,
                columns:columns
            })
            console.log(res)
        })
    }


    render() {
        return (
            <div>
                <Table columns={this.state.columns} dataSource={this.state.list}/>
            </div>
        );
    }
}