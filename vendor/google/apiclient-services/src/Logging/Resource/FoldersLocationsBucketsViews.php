<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\Logging\Resource;

use Google\Service\Logging\ListViewsResponse;
use Google\Service\Logging\LogView;
use Google\Service\Logging\LoggingEmpty;

/**
 * The "views" collection of methods.
 * Typical usage is:
 *  <code>
 *   $loggingService = new Google\Service\Logging(...);
 *   $views = $loggingService->views;
 *  </code>
 */
class FoldersLocationsBucketsViews extends \Google\Service\Resource
{
  /**
   * Creates a view over logs in a bucket. A bucket may contain a maximum of 50
   * views. (views.create)
   *
   * @param string $parent Required. The bucket in which to create the view
   * "projects/[PROJECT_ID]/locations/[LOCATION_ID]/buckets/[BUCKET_ID]" Example:
   * "projects/my-logging-project/locations/my-location/buckets/my-bucket"
   * @param LogView $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string viewId Required. The id to use for this view.
   * @return LogView
   */
  public function create($parent, LogView $postBody, $optParams = [])
  {
    $params = ['parent' => $parent, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('create', [$params], LogView::class);
  }
  /**
   * Deletes a view from a bucket. (views.delete)
   *
   * @param string $name Required. The full resource name of the view to delete: "
   * projects/[PROJECT_ID]/locations/[LOCATION_ID]/buckets/[BUCKET_ID]/views/[VIEW
   * _ID]" Example: "projects/my-project-id/locations/my-location/buckets/my-
   * bucket-id/views/my-view-id".
   * @param array $optParams Optional parameters.
   * @return LoggingEmpty
   */
  public function delete($name, $optParams = [])
  {
    $params = ['name' => $name];
    $params = array_merge($params, $optParams);
    return $this->call('delete', [$params], LoggingEmpty::class);
  }
  /**
   * Gets a view. (views.get)
   *
   * @param string $name Required. The resource name of the policy: "projects/[PRO
   * JECT_ID]/locations/[LOCATION_ID]/buckets/[BUCKET_ID]/views/[VIEW_ID]"
   * Example: "projects/my-project-id/locations/my-location/buckets/my-bucket-
   * id/views/my-view-id".
   * @param array $optParams Optional parameters.
   * @return LogView
   */
  public function get($name, $optParams = [])
  {
    $params = ['name' => $name];
    $params = array_merge($params, $optParams);
    return $this->call('get', [$params], LogView::class);
  }
  /**
   * Lists views on a bucket. (views.listFoldersLocationsBucketsViews)
   *
   * @param string $parent Required. The bucket whose views are to be listed:
   * "projects/[PROJECT_ID]/locations/[LOCATION_ID]/buckets/[BUCKET_ID]"
   * @param array $optParams Optional parameters.
   *
   * @opt_param int pageSize Optional. The maximum number of results to return
   * from this request. Non-positive values are ignored. The presence of
   * nextPageToken in the response indicates that more results might be available.
   * @opt_param string pageToken Optional. If present, then retrieve the next
   * batch of results from the preceding call to this method. pageToken must be
   * the value of nextPageToken from the previous response. The values of other
   * method parameters should be identical to those in the previous call.
   * @return ListViewsResponse
   */
  public function listFoldersLocationsBucketsViews($parent, $optParams = [])
  {
    $params = ['parent' => $parent];
    $params = array_merge($params, $optParams);
    return $this->call('list', [$params], ListViewsResponse::class);
  }
  /**
   * Updates a view. This method replaces the following fields in the existing
   * view with values from the new view: filter. (views.patch)
   *
   * @param string $name Required. The full resource name of the view to update "p
   * rojects/[PROJECT_ID]/locations/[LOCATION_ID]/buckets/[BUCKET_ID]/views/[VIEW_
   * ID]" Example: "projects/my-project-id/locations/my-location/buckets/my-
   * bucket-id/views/my-view-id".
   * @param LogView $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string updateMask Optional. Field mask that specifies the fields
   * in view that need an update. A field will be overwritten if, and only if, it
   * is in the update mask. name and output only fields cannot be updated.For a
   * detailed FieldMask definition, see https://developers.google.com/protocol-
   * buffers/docs/reference/google.protobuf#google.protobuf.FieldMaskExample:
   * updateMask=filter.
   * @return LogView
   */
  public function patch($name, LogView $postBody, $optParams = [])
  {
    $params = ['name' => $name, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('patch', [$params], LogView::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(FoldersLocationsBucketsViews::class, 'Google_Service_Logging_Resource_FoldersLocationsBucketsViews');
