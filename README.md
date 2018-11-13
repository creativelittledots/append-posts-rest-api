# Append Posts to REST API

Get child posts or posts (and custom post types) belonging to categories (and custom taxonomies) in one single request.

## Children

To append posts to posts (where posts have child posts)

**Request**

```
/wp-json/wp/v2/<post_type>?parent=0&orderby=menu_order&order=asc&append=children
```

**Response**

```
[
    {
        "id": 4,
        "date": "2018-11-07T10:33:27",
        "date_gmt": "2018-11-07T10:33:27",
        "modified": "2018-11-07T10:59:55",
        "modified_gmt": "2018-11-07T10:59:55",
        "slug": "some-page",
        "status": "publish",
        "type": "page",
        "title": {
            "rendered": "Some Page"
        },
        "parent": 0,
        "menu_order": 0,
        "template": "",
        "children": [
            {
                "id": 5,
                "date": "2018-11-07T10:34:49",
                "date_gmt": "2018-11-07T10:34:49",
                "modified": "2018-11-07T10:46:12",
                "modified_gmt": "2018-11-07T10:46:12",
                "slug": "some-sub-page",
                "status": "publish",
                "type": "page",
                "title": {
                    "rendered": "Some Sub Page"
                },
                "parent": 4,
                "menu_order": 0,
                "template": "",
                "children": [
                    {
		                "id": 7,
		                "date": "2018-11-07T10:34:54",
		                "date_gmt": "2018-11-07T10:34:54",
		                "modified": "2018-11-07T10:46:06",
		                "modified_gmt": "2018-11-07T10:46:06",
		                "slug": "sub-sub-page",
		                "status": "publish",
		                "type": "page",
		                "title": {
		                    "rendered": "Sub Sub Page"
		                },
		                "parent": 5,
		                "menu_order": 0,
		                "template": ""
		            }
                ]
            },
            {
                "id": 6,
                "date": "2018-11-07T10:34:54",
                "date_gmt": "2018-11-07T10:34:54",
                "modified": "2018-11-07T10:46:06",
                "modified_gmt": "2018-11-07T10:46:06",
                "slug": "another-sub-page",
                "status": "publish",
                "type": "page",
                "title": {
                    "rendered": "Another Sub Page"
                },
                "parent": 4,
                "menu_order": 0,
                "template": ""
            }
        ]
    }
]
```

## Revisions

To append revisions to posts

**Request**

```
/wp-json/wp/v2/<post_type>?parent=0&orderby=menu_order&order=asc&append=revisions
```

**Response**

```
[
    {
        "id": 4,
        "date": "2018-11-07T10:33:27",
        "date_gmt": "2018-11-07T10:33:27",
        "modified": "2018-11-07T10:59:55",
        "modified_gmt": "2018-11-07T10:59:55",
        "slug": "some-page",
        "status": "publish",
        "type": "page",
        "title": {
            "rendered": "Some Page"
        },
        "parent": 0,
        "menu_order": 0,
        "template": "",
        "revisions": [
            {
                "id": 5,
                "date": "2018-11-07T10:34:49",
                "date_gmt": "2018-11-07T10:34:49",
                "modified": "2018-11-07T10:46:12",
                "modified_gmt": "2018-11-07T10:46:12",
                "slug": "some-sub-page",
                "status": "publish",
                "type": "page",
                "title": {
                    "rendered": "Some Sub Page"
                },
                "parent": 4,
                "menu_order": 0,
                "template": "",
                "children": [
                    {
		                "id": 7,
		                "date": "2018-11-07T10:34:54",
		                "date_gmt": "2018-11-07T10:34:54",
		                "modified": "2018-11-07T10:46:06",
		                "modified_gmt": "2018-11-07T10:46:06",
		                "slug": "sub-sub-page",
		                "status": "publish",
		                "type": "page",
		                "title": {
		                    "rendered": "Sub Sub Page"
		                },
		                "parent": 5,
		                "menu_order": 0,
		                "template": ""
		            }
                ]
            },
            {
                "id": 6,
                "date": "2018-11-07T10:34:54",
                "date_gmt": "2018-11-07T10:34:54",
                "modified": "2018-11-07T10:46:06",
                "modified_gmt": "2018-11-07T10:46:06",
                "slug": "another-sub-page",
                "status": "publish",
                "type": "page",
                "title": {
                    "rendered": "Another Sub Page"
                },
                "parent": 4,
                "menu_order": 0,
                "template": ""
            }
        ]
    }
]
```

## Terms

To append posts to terms (any custom taxonomy)

**Request**

```
/wp-json/wp/v2/<taxonomy>?order_by=title&order=asc&append=post,customposttype
```

**Response**

```
[
    {
        "id": 1,
        "count": 1,
        "description": "",
        "name": "Some Category",
        "slug": "some-category",
        "taxonomy": "category",
        "meta": [],
        "post": [
            {
                "id": 1,
                "date": "2018-11-07T10:55:15",
                "date_gmt": "2018-11-07T10:55:15",
                "modified": "2018-11-07T11:01:40",
                "modified_gmt": "2018-11-07T11:01:40",
                "slug": "some-post",
                "status": "publish",
                "type": "post",
                "title": {
                    "rendered": "Some Post"
                },
                "content": {
                    "rendered": "I love wordpress",
                    "protected": false
                },
                "featured_media": 0,
                "template": "",
                "categories": [
                    1
                ]
            }
        ]
    },
    {
        "id": 2,
        "count": 1,
        "description": "",
        "name": "Another Category",
        "slug": "another-category",
        "taxonomy": "category",
        "meta": [],
        "post": [
            {
                "id": 2,
                "date": "2018-11-07T10:55:15",
                "date_gmt": "2018-11-07T10:55:15",
                "modified": "2018-11-07T11:01:40",
                "modified_gmt": "2018-11-07T11:01:40",
                "slug": "some-post",
                "status": "publish",
                "type": "post",
                "title": {
                    "rendered": "Another Post"
                },
                "content": {
                    "rendered": "I really love wordpress",
                    "protected": false
                },
                "featured_media": 0,
                "template": "",
                "categories": [
                    2
                ]
            }
        ],
        "customposttype": [
            {
                "id": 3,
                "date": "2018-11-07T10:55:15",
                "date_gmt": "2018-11-07T10:55:15",
                "modified": "2018-11-07T11:01:40",
                "modified_gmt": "2018-11-07T11:01:40",
                "slug": "some-post",
                "status": "publish",
                "type": "post",
                "title": {
                    "rendered": "Another Post Type"
                },
                "content": {
                    "rendered": "I really love wordpress because of custom post types",
                    "protected": false
                },
                "featured_media": 0,
                "template": "",
                "categories": [
                    2
                ]
            }
        ]
    }
]
```
