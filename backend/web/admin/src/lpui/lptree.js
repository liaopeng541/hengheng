/**
 * Created by liao on 2018/4/24.
 */
layui.define(['layer', 'ztree'], function(exports) {
    var _MOD = 'lptree',
        tree,
        nodes,
        layer = layui.layer,
        $ = layui.jquery;
    var TreeSelect = function() {
        this.v = '1.0.0';
    };

    /**
     * 渲染treeSelect
     */
    TreeSelect.prototype.render = function(options) {
        var that = this;
        // 设置可参考ztree.js配置 URL:http://www.treejs.cn/v3/api.php
        var setting = {
            check: {
                enable: true,
                chkboxType: {
                    "Y": "",
                    "N": ""
                }
            },
            view: {
                dblClickExpand: false
            },
            data: {
                simpleData: {
                    enable: true
                }
            },
            callback: {
                beforeClick: function(treeId, treeNode) {
                    var zTree = $.fn.zTree.getZTreeObj(treeId);
                    zTree.checkNode(treeNode, !treeNode.checked, null, true);
                },
                //onClick: onClick,
                onCheck: onClick
            }
        };

        tree = $.fn.zTree.init($(options.elem), setting, options.data);

        //点击事件的处理
        function onClick(e, treeId, treeNode) {
            var zTree = $.fn.zTree.getZTreeObj(treeId)
                nodes = zTree.getCheckedNodes(true)
        }
        return that;
    };


    // 导出组件
    exports(_MOD, new TreeSelect());
});
