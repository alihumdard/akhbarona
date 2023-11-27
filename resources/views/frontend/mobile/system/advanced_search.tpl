<div id="articles_search">
	<form id="article_search_form" name="article_search_form" action="{VIVVO_PROXY_URL}search.html">
		<div class="form_line">
			<label><vte:value select="{LNG_SEARCH_FORM_KEYWORD}" />:</label>
			<div class="formElement">
				<input type="text" class="text" name="search_query" value="" style="width: 240px;" />
			</div>
		</div>
		<div class="form_line">
			<label> </label>
			<div class="formElement">
			<label><input type="checkbox" name="search_title_only" value="1" /><vte:value select="{LNG_SEARCH_FORM_TITLES_ONLY}" /></label>
			</div>
		</div>
		<div class="form_line">
			<label><vte:value select="{LNG_SEARCH_FORM_AUTHOR}" />:</label>
			<div class="formElement">
				<input type="text" class="text" name="search_author" value="" style="width: 240px;" />
			</div>
		</div>
		<div class="form_line">
			<label> </label>
			<div class="formElement">
			<label><input type="checkbox" name="search_author_exact_name" value="1" checked="checked" /><vte:value select="{LNG_SEARCH_FORM_EXACT_NAME}" /></label>
			</div>
		</div>
		<div class="form_line">
			<label><vte:value select="{LNG_SEARCH_FORM_POST}" />:</label>
			<div class="formElement">
				<select class="options" name="search_search_date" style="width: 240px;">
					<option value="0" selected="selected"><vte:value select="{LNG_SEARCH_OPTION_ANY_DATE}" /></option>
					<option value="1"><vte:value select="{LNG_SEARCH_OPTION_YESTRDAY}" /></option>
					<option value="7"><vte:value select="{LNG_SEARCH_OPTION_A_WEEK_AGO}" /></option>
					<option value="14"><vte:value select="{LNG_SEARCH_OPTION_2_WEEKS_AGO}" /></option>
					<option value="30"><vte:value select="{LNG_SEARCH_OPTION_A_MONTH_AGO}" /></option>
					<option value="90"><vte:value select="{LNG_SEARCH_OPTION_3_MONTHS_AGO}" /></option>
					<option value="180"><vte:value select="{LNG_SEARCH_OPTION_6_MONTHS_AGO}" /></option>
					<option value="365"><vte:value select="{LNG_SEARCH_OPTION_A_YEAR_AGO}" /></option>
				</select>
			</div>
		</div>
		<div class="form_line">
			<label> </label>
			<div class="formElement">
			<label><input type="checkbox" name="search_before_after" value="1" checked="checked" /><vte:value select="{LNG_SEARCH_FORM_AND_OLDER}" /></label>
			</div>
		</div>
		<div class="form_line">
			<label><vte:value select="{LNG_SEARCH_FORM_CATEGORIES}" />:</label>
			<div class="formElement">
				<select class="options" id="search_cid" name="search_cid[]" size="13" multiple="multiple" style="width: 240px;">
					<option value="0" selected="selected"><vte:value select="{LNG_SEARCH_ALL_CATEGORIES}" /></option>
					<vte:box module="box_sections">
						<vte:params>
							<vte:param name="id" value="{VIVVO_ROOT_CATEGORY}" />
							<vte:param name="prefix" value="" />
						</vte:params>
						<vte:template>
							<vte:foreach item = "category" from = "{categories}">
								<vte:if test="{category.category_name} != ''">
									<option value="{category.id}"><vte:value select="{prefix}" />- <vte:value select="{category.category_name}" /></option>
									<vte:if test="{category.subcategories}">
											<vte:load module="box_sections" id="{category.id}" template_string="{template_string}" prefix="&#160;{prefix}" />
									</vte:if>
								</vte:if>
							</vte:foreach>
						</vte:template>
					</vte:box>
				</select>
			</div>
		</div>
		<input type="hidden" name="search_tag" value="" />
		<input type="hidden" name="search_options" value="" />
		<div class="form_line">
			<label> </label>
			<div class="formElement">
				<input type="submit" name="search_do_advanced" value="{LNG_SEARCH_BUTTON}" />
			</div>
		</div>
	</form>
</div>
