<div class="relative flex-1 w-0 xl:flex xl:flex-col justify-end xl:w-3/5 bg-[url('/assets/images/IMG_4471.webp')] bg-cover">
	<div class="mx-auto">
		<img src="/assets/images/FaPhoLogo-white@2x.png" class="">
	</div>
</div>
<div class="flex flex-col w-full xl:w-2/5 lg:flex-none xl:px-8">
	<div class="flex flex-col gap-6 bg-white p-8 w-full min-w-96 mx-auto shrink-0">
		<div class="mx-auto w-full">
			<h1 class="relative text-4xl font-bold tracking-tighter">Lynwood Park Church</h1>
			<h2 class="relative text-2xl font-medium tracking-tighter text-gray-400">Fundraiser Photography Packages</h2>
		</div>
		<?php if (isset($Flash) && $Flash->has('error')) : ?>
			<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center" role="alert">
				<strong class="font-semibold block sm:inline"><?= $Flash->get('error')[0] ?></strong>
			</div>
			<?php $Flash->clear() ?>
		<?php endif; ?>
		<form x-data="{ package: { selection: null, type: null }, delivery: { method: null, contact: null } }" class="space-y-6" action="#" method="POST">
			<div class="w-full">
				<label for="package[selection]" class="block text-sm font-medium text-gray-700">
					Fundraiser Package
				</label>
				<div class="mt-1">
					<select name="package[selection]" class="w-full appearance-none block px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-lg" x-model="package.selection" @change="package.type = (['package-d', 'package-e'].includes(package.selection) ? 'individual' : 'group')">
						<option>Select a Fundraiser Package</option>
						<option value="package-a">Package A: Group Portrait &mdash; Mixed (8 Max)</option>
						<option value="package-b">Package B: Group Portrait &mdash; Adults Only (5 Max)</option>
						<option value="package-c">Package C: Group Portrait &mdash; Children Only (6 Max)</option>
						<option value="package-d">Package D: Individual Portrait &mdash; Adult</option>
						<option value="package-e">Package E: Individual Portrait &mdash; Child</option>
					</select>
				</div>
			</div>

			<input name="package[type]" type="hidden" x-model="package.type" value="">

			<div x-show="package.type=='individual'" class="flex items-center gap-6 w-full">
				<div class="w-1/2">
					<label for="subject[first_name]" class="block text-sm font-medium text-gray-700">
						First Name
					</label>
					<div class="mt-1">
						<input name="subject[first_name]" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-lg">
					</div>
				</div>

				<div class="w-1/2">
					<label for="subject[last_name]" class="block text-sm font-medium text-gray-700">
						Last Name
					</label>
					<div class="mt-1">
						<input name="subject[last_name]" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-lg">
					</div>
				</div>
			</div>

			<div x-show="package.type=='group'">
				<label for="subject[group_name]" class="block text-sm font-medium text-gray-700">
					Group Name
				</label>
				<div class="mt-1">
					<input name="subject[group_name]" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-lg">
				</div>
			</div>

			<div class="flex items-center gap-6 w-full">
				<div class="w-fit">
					<label for="delivery[method]" class="block text-sm font-medium text-gray-700">
						Preferred Delivery
					</label>
					<div class="mt-1">
						<select name="delivery[method]" class="appearance-none block px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-lg" x-model="delivery.method" @change="console.log(delivery.method)">
							<option></option>
							<option value="email">Email</option>
							<option value="text">Text Message</option>
						</select>
					</div>
				</div>

				<div class="w-full" x-show="delivery.method">
					<label for="delivery[contact]" class="block text-sm font-medium text-gray-700" x-text="delivery.method == 'email' ? 'Email Address' : 'Mobile Number'">
						Contact
					</label>
					<div class="mt-1">
						<input name="delivery[contact]" type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-lg">
					</div>
				</div>
			</div>

			<div>
				<button type="submit" class="w-full flex justify-center px-3 py-4 text-md font-medium text-white border-2 border-courageous-plum rounded-md bg-orange-500 hover:bg-orange-400 focus:ring-4 focus:outline-none focus:ring-courageous-plum-400 uppercase">
					Register
				</button>
			</div>
		</form>
	</div>
</div>
