<template>
	<div class="page-container">
		<div class="highscores-container">

		</div>
		<div class="memory-game d-flex flex-wrap">
			<MemoryCard image="img/triforce.png"></MemoryCard>
			<MemoryCard image="img/mario.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/portal.png"></MemoryCard>
			<MemoryCard image="img/gta.png"></MemoryCard>
			<MemoryCard image="img/smash.png"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
			<MemoryCard image="img/kirby.webp"></MemoryCard>
		</div>
	</div>
</template>

<script>
import router from "../router";
import {useToast} from "vue-toastification";
import MemoryCard from "../components/MemoryCard.vue";
export default {
	data() {
		return {
			
		}
	},

	components: {
		MemoryCard
	},

	mounted(){
	},

	methods: {
	}
}
</script>

<style>
</style>