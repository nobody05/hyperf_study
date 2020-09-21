import axios from 'axios'
import {Modal} from "antd"

export default class Axios {
    static ajax(options) {
        return new Promise((resolve, reject) =>{
            axios({
                url:options.url,
                baseURL: 'http://127.0.0.1:9501',
                method:options.method,
                timeout:5000,
            }).then((response)=>{
                if (response.status === 200){
                    let res = response.data;
                    resolve(res);
                } else {
                    Modal.info({
                        title:"错误",
                        content:"请求失败"
                    });
                    reject(response.data);
                }
            })
        })
    }
}