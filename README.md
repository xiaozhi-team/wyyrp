# 网易云随机热评 API

#### 介绍

网易云随机热评 API
请求后返回随机热评

#### 建议 PHP 版本

建议使用 PHP(7.4)

#### 使用说明

直接对 PHP 进行访问即可

#### 提交参数

| 序列号 | 名称 | 必填 | 备注                                                |
| ------ | ---- | ---- | --------------------------------------------------- |
| 1      | type | 否   | Type 为 text,返回文本,为 Json,返回 Json 默认为 Json |
| 2      | text | 否   | 指定歌单 id 获取热评，默认网易云热歌榜              |

#### 返回数据

| 序列号 | 返回头  | 返回类型 | 备注             |
| ------ | ------- | -------- | ---------------- |
| 1      | code    | int      | 状态码           |
| 2      | text    | string   | 返回提示         |
| 3      | data    | array    | 返回数据         |
| 4      | Music   | string   | 歌名             |
| 5      | name    | string   | 歌手名字         |
| 6      | Picture | string   | 歌曲封面图片链接 |
| 7      | Url     | string   | 播放链接         |
| 8      | Content | string   | 评论内容         |
| 9      | Nick    | string   | 发表评论的昵称   |
| 10     | api     | string   | api 系统名称     |

#### 返回示例

```
{
    "code": 1,
    "text": "获取成功",
    "data": {
        "Music": "遇见你，微风起",
        "name": "刘大拿",
        "Picture": "http://p1.music.126.net/Vsulb9zNiRZxpK_YwATIPA==/109951168996300510.jpg",
        "Url": "http://music.163.com/song/media/outer/url?id=2091638406",
        "id": 2091638406,
        "Content": "爱应该让人变得温柔和勇敢。",
        "Nick": "黄桃不是桃c"
    },
    "api": "https://api.4qb.cn/"
}
```

#### 问题联系

出现任何问题可提交 Issues

#### API

欢迎各位使用小职 API：[api.4qb.cn](https://api.41b.cn/)
